import React, { useState } from 'react'
import AutocompleteSelect from '../../components/AutocompleteSelect.jsx'
import CardsGrid from '../../components/CardsGrid.jsx'
import Heading from '../../components/Heading.jsx'
import ButtonDownload from '../../components/ButtonDownload.jsx'

const Index = ({ sets, randomCards }) => {
    const [selectedSet, setSelectedSet] = useState(null)
    const [fetchedCards, setFetchedCards] = useState([])

    const fetchSelectedSetFromApi = async () => {
        try {
            const response = await window.axios({
                method: 'GET',
                url: `/cards/fetch?setCode=${selectedSet}`,
            })
            const cardObject = response.data
            cardObject["source"] = 'api'
            setFetchedCards(cardObject)
        } catch (error) {
            console.error('Error fetching cards:', error)
        }
    }

    const fetchSelectedSetFromDb = async (value) => {
        try {
            const response = await window.axios({
                method: 'GET',
                url: `/cards/fetchdb?setCode=${value}`,
            })
            const cardObject = response.data
            cardObject["source"] = 'db'
            setFetchedCards(cardObject)
        } catch (error) {
            console.error('Error fetching cards:', error)
        }
    }

    return (
        <div className="">
            <div className="mx-auto mb-6">
               <Heading textBefore="Magic" textMarked="The Gathering" textAfter="cards" />
                <div className="mt-12 flex justify-evenly align-baseline max-w-md mx-auto">
                    <AutocompleteSelect
                        sets={sets}
                        setSelectedSet={setSelectedSet}
                        fetchSelectedSetFromDb={fetchSelectedSetFromDb}
                    />
                    <ButtonDownload
                        fetchSelectedSetFromApi={fetchSelectedSetFromApi}
                        disabled={!(fetchedCards.length === 0 && selectedSet)}
                        text="get cards"
                    />
                </div>
            </div>

            {
                randomCards && !selectedSet
                    ?   <CardsGrid cards={randomCards} source={randomCards.source} />
                    :   null
            }

            {
                fetchedCards.length > 0
                    ?   <CardsGrid cards={fetchedCards} source={fetchedCards.source} />
                    :   null
            }

        </div>
    )
}

export default Index
