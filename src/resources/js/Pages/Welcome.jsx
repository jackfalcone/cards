import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';

export default function Welcome(props) {
    return (
        <div>
            <h1>Welcome to Laravel Inertia React!</h1>
            <InertiaLink href='/about'>About</InertiaLink>
        </div>
    );
}
