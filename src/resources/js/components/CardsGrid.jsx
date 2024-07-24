import React, { useState, useEffect, useMemo } from 'react'
import Card from './Card.jsx'
import { trackWindowScroll } from 'react-lazy-load-image-component'
import CardsGridHeader from './CardsGridHeader.jsx'

const CardsGrid = ({ cards, source, selectedSetIconUri, selectedSetLabel, scrollPosition }) => {
    const [priceSetUsd, setPriceSetUsd] = useState(0)
    const [setAmount, setSetAmount] = useState(0)

    const calculateTotalPrice = (cards) => {
        const pricesUsd = cards.map(card => JSON.parse(card.prices)?.usd || 0)
        return pricesUsd.reduce((total, price) => total + Number(price), 0)
    }

    const calculateSetAmount = (cards) => cards.length

    useEffect(() => {
        setPriceSetUsd(calculateTotalPrice(cards))
        setSetAmount(calculateSetAmount(cards))
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
                {cards.map(card => (
                    <Card key={card.id} card={card} source={source} scrollPosition={scrollPosition} />
                ))}
            </div>
        </div>
    )
}

export default trackWindowScroll(CardsGrid)
