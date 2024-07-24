import React, { useState, useEffect } from 'react'
import { LazyLoadImage } from 'react-lazy-load-image-component'
import 'react-lazy-load-image-component/src/effects/blur.css'

const Card = ({ card, source, scrollPosition }) => {
    const [imgUrl, setImgUrl] = useState({})
    const [fallback, setFallback] = useState('')

    useEffect(() => {
        const cardObjImageUris = JSON.parse(card['image_uris']);
        setFallback(cardObjImageUris.large)
        if (source === 'api') {
            const imgUrlObj = {
                small: cardObjImageUris ? cardObjImageUris.small : '',
                normal:  cardObjImageUris ? cardObjImageUris.normal : '',
                large:  cardObjImageUris ? cardObjImageUris.large : '',
            }
            setImgUrl(imgUrlObj)
        } else {
            const imgUrlObj = {
                small: `/storage/images/${card.scryfall_id}/small.jpg`,
                normal: `/storage/images/${card.scryfall_id}/normal.jpg`,
                large: `/storage/images/${card.scryfall_id}/large.jpg`,
            }
            setImgUrl(imgUrlObj)
        }
    }, []);

    return (
        <picture className="m-8 max-w-sm shadow-xl shadow-indigo-200 leading-none">
            <LazyLoadImage
                alt={card.name}
                effect="blur"
                scrollPosition={scrollPosition}
                src={imgUrl.large}
                srcSet={`
                ${imgUrl.small} 300w,
                ${imgUrl.normal} 768w,
                ${imgUrl.large} 1280w`
                }
                sizes="(max-width: 300px) 300px, (max-width: 768px) 768px, 1280px"
                onError={e => {e.target.onError = null; e.target.src= fallback}}
            />
        </picture>
    )
}

export default Card
