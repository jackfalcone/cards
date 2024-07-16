import React from 'react'
import Card from './Card.jsx'

const CardsGrid = ({ cards }) => {

    return(
        <div className="flex flex-wrap justify-center">
            {
                cards.map((card) => (
                    <Card key={card.id} card={card}/>
                ))
            }
        </div>
    )
}

export default CardsGrid
