import React from 'react'

const Heading = ({ textBefore, textMarked, textAfter}) => (
    <div className="mx-auto max-w-max">
        <h1 className="
        mt-6
        mb-4
        mx-auto
        text-4xl
        font-extrabold
        leading-none
        tracking-tight
        text-gray-900
        md:text-5xl
        lg:text-6xl
        ">
            {textBefore}
            <mark className="px-2 text-white bg-blue-600 rounded">
                {textMarked}
            </mark>
            {textAfter}
        </h1>
    </div>
)

export default Heading
