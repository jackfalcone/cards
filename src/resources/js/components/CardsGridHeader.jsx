import React from 'react'
import LocalAtmOutlinedIcon from '@mui/icons-material/LocalAtmOutlined'
import FunctionsOutlinedIcon from '@mui/icons-material/FunctionsOutlined'

const CardsGridHeader = ({ selectedSetIconUri, priceSetUsd, setAmount, selectedSetLabel }) => (
    <div className="flex flex-col items-center justify-evenly mx-auto min-w-80 mt-6 mb-4">
        <div className="flex flex-row items-center">
            {selectedSetIconUri
                ?   <img
                    loading="lazy"
                    className="w-12 h-12"
                    src={selectedSetIconUri}
                    alt=""
                />
                : null
            }
            <h2 className="ml-1 text-lg font-bold">{ selectedSetLabel ? selectedSetLabel : null }</h2>
        </div>
        <div className="flex flex-row items-center mt-3 text-base">
            <div className="flex flex-row items-center">
                <FunctionsOutlinedIcon className="opacity-65"/>
                <span>{setAmount ? `${setAmount} card${setAmount > 1 ? 's' : ''}` : 'N/A'}</span>
            </div>
            <div className="flex flex-row items-center ml-6">
                <LocalAtmOutlinedIcon className="opacity-65" />
                <span className="ml-1">{priceSetUsd ? `${priceSetUsd.toFixed(2)} USD` : 'N/A'}</span>
            </div>
        </div>
    </div>
)

export default CardsGridHeader
