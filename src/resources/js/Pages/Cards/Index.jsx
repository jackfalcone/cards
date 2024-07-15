import React, { useState, useEffect } from 'react';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import {Inertia} from "@inertiajs/inertia";

const Index = ({ sets, randomCards }) => {
    const [selectedSet, setSelectedSet] = useState();
    const [fetchedCards, setFetchedCards] = useState([]);

    const fetchSelectedSetFromApi = async () => {
        if (!selectedSet) return;

        try {
            const response = await window.axios({
                method: 'GET',
                url: '/cards/fetch?setCode='+selectedSet,
            });
            setFetchedCards(response.data);
        } catch (error) {
            console.error('Error fetching cards:', error);
        }
    };

    const fetchSelectedSetFromDb = async (value) => {

        try {
            const response = await window.axios({
                method: 'GET',
                url: '/cards/fetchdb?setCode='+value,
            });
            setFetchedCards(response.data);
        } catch (error) {
            console.error('Error fetching cards:', error);
        }
    };

    const selectSet = (e) => {
        e.preventDefault()
        setSelectedSet(e.target.value);
        fetchSelectedSetFromDb(e.target.value)
    }


    return (
        <div>

            <select onChange={(e) => selectSet(e)} value={selectedSet}>
                <option value="">Select a set</option>
                {sets.map((set) => (
                    <option key={set.id} value={set.code} selected={selectedSet === set.code}>{set.name}</option>
                ))}
            </select>

            {
                randomCards && !selectedSet
                ?   randomCards.map((card) => (
                        <div key={card.id}>{card.name}</div>
                    ))
                :   null
            }

            {
                fetchedCards.length === 0 && selectedSet
                ?   <div>
                        <button onClick={fetchSelectedSetFromApi}>Fetch</button>
                    </div>
                :   null
            }

            {
                fetchedCards.length > 0
                ?   fetchedCards.map((card) => (
                        <div key={card.id}>{card.name}</div>
                    ))
                :   null
            }

        </div>
    )
}

export default Index;
