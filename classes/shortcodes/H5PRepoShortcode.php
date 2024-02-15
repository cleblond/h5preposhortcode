<?php
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Grav;
use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class H5PRepoShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('h5prepo', function(ShortcodeInterface $sc) {

            // Get shortcode content and parameters
            $str = $sc->getContent();

            $h5pid = $sc->getParameter('id', $sc->getBbCode());
            
            //dump($h5pid);

            $config = (array) $this->config->get('plugins')['h5preposhortcode'];

            if ($h5pid) {
                //$config = Grav::instance()['config'];
                //$h5proot = $config->get('themes.' . $config->get('system.pages.theme') . '.h5pembedrootpath');
                $h5proot = $config['h5purl'];

                if (strpos($h5proot, 'h5p.com') !== false) {
                    $output = '<p><iframe src="'.$h5proot.''.$h5pid.'/embed" width="400" height="300" frameborder="0" allowfullscreen="allowfullscreen"></iframe><script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-resizer.js" charset="UTF-8"></script></p>';
                } else {
                    $output = '<p><iframe src="'.$h5proot.''.$h5pid.'" width="400" height="300" frameborder="0" allowfullscreen="allowfullscreen"></iframe><script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-resizer.js" charset="UTF-8"></script></p>';
                }

                return $output;
            }

            $h5purl= $sc->getParameter('url', $sc->getBbCode());

            if ($h5purl) {
                $output = '<p><iframe src="'.$h5purl.'" width="400" height="300" frameborder="0" allowfullscreen="allowfullscreen"></iframe><script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-resizer.js" charset="UTF-8"></script></p>';

                return $output;
            }

        });
    }
}
