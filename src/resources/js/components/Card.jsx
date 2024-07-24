import React from 'react'
import { LazyLoadImage } from 'react-lazy-load-image-component'
import 'react-lazy-load-image-component/src/effects/blur.css'

// 'image_uris' is external (when fetched from API and not yet saved locally)
// 'imgs_local' is the local images
const Card = ({ card, source, scrollPosition }) => (
    <picture className="m-8 max-w-sm shadow-xl shadow-indigo-200 leading-none">
        <LazyLoadImage
            alt={card.name}
            effect="blur"
            scrollPosition={scrollPosition}
            src={source === 'api' ? JSON.parse(card['image_uris']).large : 'storage/' + card['imgs_local'].large}
            srcSet={`
                ${source === 'api' ? JSON.parse(card['image_uris']).small : 'storage/' + card['imgs_local'].small} 300w,
                ${source === 'api' ? JSON.parse(card['image_uris']).normal : 'storage/' + card['imgs_local'].normal} 768w,
                ${source === 'api' ? JSON.parse(card['image_uris']).large : 'storage/' + card['imgs_local'].large} 1280w`
            }
            sizes="(max-width: 300px) 300px, (max-width: 768px) 768px, 1280px"
            onError={e => {e.target.onError = null; JSON.parse(card['image_uris']).large}}
        />
    </picture>
)

export default Card
