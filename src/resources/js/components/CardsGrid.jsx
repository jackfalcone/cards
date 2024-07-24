import React, { useState, useEffect } from 'react'
import Card from './Card.jsx'
import { trackWindowScroll } from 'react-lazy-load-image-component'
import CardsGridHeader from './CardsGridHeader.jsx'

const CardsGrid = ({ cards, source, selectedSetIconUri, selectedSetLabel, scrollPosition }) => {
    const [priceSetUsd, setPriceSetUsd] = useState()
    const [setAmount, setSetAmount] = useState()

    useEffect(() => {
        const pricesUsd = cards.map(card => JSON.parse(card['prices'])['usd'])
        const pricesUsdNotNull = pricesUsd.filter(price => price)
        setPriceSetUsd(pricesUsdNotNull.reduce((prev, next) => prev + Number(next), 0))
        setSetAmount(cards.length)
    }, [cards])

    return (
        <div className="flex flex-col">
            <div className="mx-auto">
                <CardsGridHeader
                    selectedSetIconUri={selectedSetIconUri}
                    priceSetUsd={priceSetUsd}
                    setAmount={setAmount}
                    selectedSetLabel={selectedSetLabel}
                />
            </div>
            <div className="flex flex-wrap justify-center">
                {
                    cards.map((card) => (
                        <Card key={card.id} card={card} source={source} scrollPosition={scrollPosition}/>
                    ))
                }
            </div>
        </div>
    )
}

export default trackWindowScroll(CardsGrid)
