import React, { useState, useEffect } from 'react';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import {Inertia} from "@inertiajs/inertia";

const Index = ({ sets, cards, setCode }) => {
    const [selectedSet, setSelectedSet] = useState(setCode || '');
    const [fetchedCards, setFetchedCards] = useState(cards || []);
    const fetchSelectedSetFromDb = (setCode) => {
        Inertia.get('/', { setCode: setCode });
    };

    const fetchSelectedSetFromApi = async () => {
        if (!selectedSet) return;

        console.log('fetching!');
        try {
            const response = await window.axios({
                method: 'GET',
                url: '/cards/fetch?setCode='+selectedSet,
            });
            console.log(response.data)
            setFetchedCards(response.data);
        } catch (error) {
            console.error('Error fetching cards:', error);
        }
    };

    const selectSet = (selectedSet) => {
        setSelectedSet(selectedSet);
        fetchSelectedSetFromDb(selectedSet)
    }

    useEffect(() => {
        if (setCode) {
            setSelectedSet(setCode);
            setFetchedCards([...fetchedCards, cards]);
        }
    }, [setCode, cards]);


    console.log(sets)
    return (
        <div>

            <select onChange={(e) => selectSet(e.target.value)} value={selectedSet}>
                <option value="">Select a set</option>
                {sets.map((set) => (
                    <option key={set.id} value={set.code} selected={selectedSet === set.code}>{set.name}</option>
                ))}
            </select>
            <div>
                <button onClick={fetchSelectedSetFromApi}>Fetch</button>

            </div>


            {fetchedCards.length > 0 ? (
                fetchedCards.map((card) => (
                    <div key={card.id}>{card.name}</div>
                ))
            ) : (
                <div>No cards found.</div>
            )}



        </div>
    )
}

export default Index;
