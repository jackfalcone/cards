import React from 'react'
import Card from './Card.jsx'
import { trackWindowScroll } from 'react-lazy-load-image-component'

const CardsGrid = ({ cards, source, scrollPosition }) => (
    <div className="flex flex-wrap justify-center">
        {
            cards.map((card) => (
                <Card key={card.id} card={card} source={source} scrollPosition={scrollPosition} />
            ))
        }
    </div>
)

export default trackWindowScroll(CardsGrid)
