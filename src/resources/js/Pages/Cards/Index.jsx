import React, { useState } from 'react'
import AutocompleteSelect from '../../components/AutocompleteSelect.jsx'
import CardsGrid from '../../components/CardsGrid.jsx'
import Heading from '../../components/Heading.jsx'
import ButtonDownload from '../../components/ButtonDownload.jsx'

const Index = ({ sets, randomCards }) => {
    const [selectedSet, setSelectedSet] = useState(null)
    const [fetchedCards, setFetchedCards] = useState([])
    const [selectedSetIconUri, setSelectedSetIconUri] = useState(null)
    const [selectedSetLabel, setSelectedSetLabel] = useState(null)

    const fetchCards = async (url, accumulatedCards = []) => {
        try {
            const response = await window.axios.get(url)
            const newCards = response.data
            const allCards = [...accumulatedCards, ...newCards]

            if (response.next_page) {
                await fetchCards(response.next_page, allCards)
            } else {
                setFetchedCards(allCards)
            }
        } catch (error) {
            console.error('Error fetching cards:', error)
        }
    }

    const fetchSelectedSetFromApi = () => fetchCards(`/cards/fetch?setCode=${selectedSet}`)

    const fetchSelectedSetFromDb = (value) => fetchCards(`/cards/fetchdb?setCode=${value}`)

    return (
        <div>
            <div className="mx-auto mb-6">
                <Heading textBefore="Magic" textMarked="The Gathering" textAfter="Cards" />
                <div className="mt-12 flex flex-wrap justify-evenly align-baseline max-w-md mx-auto">
                    <AutocompleteSelect
                        sets={sets}
                        setSelectedSet={setSelectedSet}
                        fetchSelectedSetFromDb={fetchSelectedSetFromDb}
                        setSelectedSetIconUri={setSelectedSetIconUri}
                        setSelectedSetLabel={setSelectedSetLabel}
                    />
                    <ButtonDownload
                        fetchSelectedSetFromApi={fetchSelectedSetFromApi}
                        disabled={!(!fetchedCards.length && selectedSet)}
                        text="get cards"
                    />
                </div>
            </div>

            {randomCards && !selectedSet && (
                <CardsGrid cards={randomCards} source={randomCards.source} />
            )}

            {fetchedCards.length > 0 && (
                <CardsGrid
                    cards={fetchedCards}
                    source={fetchedCards.source}
                    selectedSetIconUri={selectedSetIconUri}
                    selectedSetLabel={selectedSetLabel}
                />
            )}
        </div>
    )
}

export default Index
