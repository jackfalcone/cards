import React from 'react'
import DownloadForOfflineOutlinedIcon from '@mui/icons-material/DownloadForOfflineOutlined'
import Button from '@mui/material/Button'

const ButtonDownload = ({ fetchSelectedSetFromApi, disabled, text }) => (
    <Button variant="outlined" onClick={() => fetchSelectedSetFromApi()} disabled={disabled}>
        <DownloadForOfflineOutlinedIcon/>
        {text}
    </Button>
)

export default ButtonDownload
