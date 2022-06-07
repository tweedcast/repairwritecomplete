import React from 'react';
import { Head } from '@inertiajs/inertia-react';
import CCCOne from '@/Layouts/Repair/CCCOne';

export default function RepairReview(props) {
    return (
        <CCCOne repair={props.repair}/>
    );
}
