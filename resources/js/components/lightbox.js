import PhotoSwipeLightbox from 'photoswipe/lightbox'
import 'photoswipe/style.css'

export default {
    getLightbox(name = '#gallery', children = 'a') {
        let lightbox = new PhotoSwipeLightbox({
            gallery: name,
            children: children,
            pswpModule: () => import('photoswipe'),
        })
        
        lightbox.init()
    }
}

