import React, { useState, useEffect } from 'react'
import AutocompleteSelect from '../../components/AutocompleteSelect.jsx'
import CardsGrid from '../../components/CardsGrid.jsx'
import Heading from '../../components/Heading.jsx'
import ButtonDownload from '../../components/ButtonDownload.jsx'

const Index = ({ sets, randomCards }) => {
    const [selectedSet, setSelectedSet] = useState()
    const [fetchedCards, setFetchedCards] = useState([])

    const fetchSelectedSetFromApi = async () => {
        try {
            const response = await window.axios({
                method: 'GET',
                url: `/cards/fetch?setCode=${selectedSet}`,
            })
            setFetchedCards(response.data);
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
            setFetchedCards(response.data);
        } catch (error) {
            console.error('Error fetching cards:', error)
        }
    }

    return (
        <div className="">
            <div className="mx-auto border border-red-600">
               <Heading textBefore="Magic" textMarked="The Gathering" textAfter="cards" />
                <div className="flex justify-evenly align-baseline max-w-md mx-auto border border-orange-600">
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
                    ?   <CardsGrid cards={randomCards} />
                    :   null
            }


            {
                fetchedCards.length > 0
                    ?   <CardsGrid cards={fetchedCards} />
                    :   null
            }

        </div>
    )
}

export default Index
