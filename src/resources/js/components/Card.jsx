import React from 'react'
import { LazyLoadImage } from 'react-lazy-load-image-component'
import 'react-lazy-load-image-component/src/effects/blur.css'

const getLocalImage = (imgs_local, size) => imgs_local && imgs_local[size] ? `storage/${imgs_local[size]}` : null

const getExternalImage = (card, size) => {
    if (card.image_uris) {
        const imageUris = JSON.parse(card.image_uris)
        return imageUris[size]
    } else if (card.card_faces && card.card_faces[0].image_uris) {
        const cardFaceImageUris = JSON.parse(card.card_faces[0].image_uris)
        return cardFaceImageUris[size]
    }
    return null
};

const getImageSrc = (card, size) => getLocalImage(card.imgs_local, size) || getExternalImage(card, size)

const Card = ({ card, scrollPosition }) => {
    const src = getImageSrc(card, 'large')
    const srcSet = `
        ${getImageSrc(card, 'small')} 300w,
        ${getImageSrc(card, 'normal')} 768w,
        ${getImageSrc(card, 'large')} 1280w
    `

    return (
        <picture className="m-8 max-w-sm shadow-xl shadow-indigo-200 leading-none">
            <LazyLoadImage
                alt={card.name}
                effect="blur"
                scrollPosition={scrollPosition}
                src={src}
                srcSet={srcSet}
                sizes="(max-width: 300px) 300px, (max-width: 768px) 768px, 1280px"
            />
        </picture>
    )
}

export default Card
