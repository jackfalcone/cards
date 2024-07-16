import React from 'react'
import Card from './Card.jsx'

const CardsGrid = ({ cards, source }) => (
    <div className="flex flex-wrap justify-center">
        {
            cards.map((card) => (
                <Card key={card.id} card={card} source={source} />
            ))
        }
    </div>
)

export default CardsGrid
