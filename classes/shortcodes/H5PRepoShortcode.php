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

            $h5prepoid = $sc->getParameter('id', $sc->getBbCode());
            
            //dump($h5pid);

            $config = (array) $this->config->get('plugins')['h5preposhortcode'];

            if ($h5prepoid) {
                
                $output =
                
		  "<script>
		  (function() {
			let h5pinstance = document.currentScript;
			//console.log(h5pinstance);
			let h5pContainer = document.createElement('div');
			h5pinstance.parentNode.insertBefore(h5pContainer, null);

			let h5pJsonPath = '/learn/user/data/h5pobj/".$h5prepoid."'; // H5P data directory path
			
			if (!document.getElementById('h5p-bundle-js')) {
			  let script = document.createElement('script');
			  script.id = 'h5p-bundle-js';
			  script.src = '/learn/user/plugins/h5preposhortcode/libs/h5p/main.bundle.js';
			  h5pContainer.parentNode.insertBefore(script, h5pContainer.nextSibling);
			}

			window.addEventListener('load', function() {
			  const options = {
				h5pJsonPath: h5pJsonPath,
				frameJs: '/learn/user/plugins/h5preposhortcode/libs/h5p/frame.bundle.js',
				frameCss: '/learn/user/plugins/h5preposhortcode/libs/h5p/styles/h5p.css',
			  }
			  new H5PStandalone.H5P(h5pContainer, options);
			});
		  }) ();
		</script>";
                
                return $output;
            }



        });
    }
}
