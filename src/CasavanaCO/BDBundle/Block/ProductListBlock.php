<?php

namespace CasavanaCO\BDBundle\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Form;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;

use CasavanaCO\BDBundle\ApplicationBoot;
/**
 * Description of ProductListBloc
 *
 * @author Sergio Álvarez López <salmaxcraft@gmail.com>
 */
class ProductListBlock extends BaseBlockService
{
    
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Rss Reader';
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultSettings()
    {
        return array(
            'url'     => false,
            'title'   => 'Insert the rss title'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
            'keys' => array(
                array('url', 'url', array('required' => false)),
                array('title', 'text', array('required' => false)),
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
        $errorElement
            ->with('settings[url]')
                ->assertNotNull(array())
                ->assertNotBlank()
            ->end()
            ->with('settings[title]')
                ->assertNotNull(array())
                ->assertNotBlank()
                ->assertMaxLength(array('limit' => 50))
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockInterface $block, Response $response = null)
    {
        // merge settings
        $settings = array_merge($this->getDefaultSettings(), $block->getSettings());

        $feeds = false;
        if ($settings['url']) {
            $options = array(
                'http' => array(
                    'user_agent' => 'Sonata/RSS Reader',
                    'timeout' => 2,
                )
            );

            // retrieve contents with a specific stream context to avoid php errors
            $content = @file_get_contents($settings['url'], false, stream_context_create($options));

            if ($content) {
                // generate a simple xml element
                try {
                    $feeds = new \SimpleXMLElement($content);
                    $feeds = $feeds->channel->item;
                } catch (\Exception $e) {
                    // silently fail error
                }
            }
        }
        
        $container = ApplicationBoot::getContainer();
        $repository = $container->get('doctrine')->getRepository('CasavanaCOBDBundle:Product');
        
        // recupera TODOS los productos
        $products = $repository->findAll();

        return $this->renderResponse('CasavanaCOBDBundle:Block:productlist.html.twig', array(
            'feeds'     => $feeds,
            'block'     => $block,
            'settings'  => $settings,
            'products'  => $products,
        ), $response);
    }
}

?>
