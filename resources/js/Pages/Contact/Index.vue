<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage()

/* console.log(page.props); */

const contacts = ref(page.props.contacts);

const onDelteSucces = (e)  => {
    /* console.log(e); */
    contacts.value = e.props.contacts;
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Contactos</h2>
                <Link :href="route('contacts.create')">
                    Crear Contacto
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nombre</th>
                                    <th scope="col" class="px-6 py-3">Telefono</th>
                                    <th scope="col" class="px-6 py-3">Visibilidad</th>
                                    <th scope="col" class="px-6 py-3">Avatar</th>
                                    <th scope="col" class="px-6 py-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr v-for="contact in contacts" :key="contact.id" class="bg-white border-b dark:bg-gray-800 ">
                                    <th scope="row" class="px-6 py-4">
                                        {{ contact.name }}
                                    </th>
                                    <th scope="row" class="px-6 py-4">
                                        {{ contact.phone }}
                                    </th>
                                    <th scope="row" class="px-6 py-4">
                                        {{ contact.privacity }}
                                    </th>
                                    <th scope="row" class="px-6 py-4 ">
                                        <img class="h-16" :src="`/storage/${contact.avatar}`">
                                    </th>
                                    <th scope="row" class="px-6 py-4">
                                        <div class="space-x-4">
                                            <Link :href="route('contacts.edit',contact)">
                                                Edidar
                                            </Link>
                                            <Link @success="onDelteSucces" :href="route('contacts.destroy',contact)" method="delete" as="button">
                                                Eliminar
                                            </Link>
                                        </div>

                                    </th>
                                </tr>

                            </tbody>

                        </table>
                    </div>


                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
