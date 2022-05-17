import React from 'react';
import AdminAuthenticated from '@/Layouts/AdminAuthenticated';
import { Head } from '@inertiajs/inertia-react';
import AdminFrame from '@/Layouts/Admin/AdminFrame';

export default function OrganizationDashboard(props) {
    return (
        <AdminAuthenticated
            auth={props.auth}
            errors={props.errors}
            currLocation={props.curr_location}
        >
            <Head title={props.organization.name} />

            <AdminFrame locations={props.locations}/>
        </AdminAuthenticated>
    );
}
