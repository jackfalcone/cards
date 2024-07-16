import React, { useState, useEffect } from 'react'
import TextField from '@mui/material/TextField'
import Autocomplete from '@mui/material/Autocomplete'
import Box from '@mui/material/Box'

const AutocompleteSelect = ({ sets, setSelectedSet, fetchSelectedSetFromDb }) => {
    const [optionsSet, setOptionsSet] = useState([])

    useEffect(() => {
        setOptionsSet(sets.map(set => {
            return {
                label: set.name,
                id: set.code,
                svgUrl: set.icon_svg_uri,
            }
        }))
    }, [])

    const handleOnChange = (event, newValue) => {
        setSelectedSet(newValue.id)
        fetchSelectedSetFromDb(newValue.id)
    }

    return(
        <div>
            <Autocomplete
                disablePortal
                id="autocomplete-select-set"
                options={optionsSet}
                sx={{ width: 350 }}
                style={{ marginLeft: 50, marginTop: 30 }}
                getOptionLabel={option => option.label}
                renderInput={params => <TextField {...params} label="Set" />}
                onChange={handleOnChange}
                renderOption={(props, option) => {
                    const {key, ...optionProps} = props;
                    return (
                        <Box
                            key={key}
                            component="li"
                            sx={{'& > img': {mr: 2, flexShrink: 0}}}
                            {...optionProps}
                        >
                            <img
                                loading="lazy"
                                width="20"
                                src={option.svgUrl}
                                alt=""
                            />
                            {option.label}
                        </Box>
                    )
                }}
            />
        </div>

    )
}

export default AutocompleteSelect
