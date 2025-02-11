<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import FileInput from "@/Components/FileInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const initialValues = {
    name: "",
    phone: "",
    avatar: null,
    privacity: "public",
};

const form = useForm(initialValues);

const onSelectAvatar = (e) =>{
    const files = e.target.files;
    if(files.length){
        form.avatar = files[0]
    }
    console.log(form.avatar)
}

const submit = () =>{
    form.post(route('contacts.store'))
}

</script>

<template>

    <Head title="Crear contacto" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Crear contacto
                </h2>
                <Link :href="route('contacts.index')"> Listar Contactos </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form class="w-1/3 py-5" @submit.prevent="submit">
                        <div>
                            <InputLabel for="name" value="Nombre" />
                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                autofocus autocomplete=name placeholder="Jhoan Moreno" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div>
                            <InputLabel for="phone" value="Telefono" />
                            <TextInput id="phone" type="text" class="mt-1 block w-full" v-model="form.phone"
                                 placeholder="+57" />
                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>
                        <div>
                            <InputLabel for="avatar" value="Avatar" />
                            <FileInput name="avatar" @change="onSelectAvatar"/>
                            <!-- <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.avatar"
                                 placeholder="+57" /> -->
                            <InputError class="mt-2" :message="form.errors.avatar" />
                        </div>
                        <div>
                            <InputLabel  for="privacity" value="Privacity" />
                            <select v-model="form.privacity"
                            class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" name="privacity" id="privacity">
                                <option value="private">Privado</option>
                                <option value="public">Publico</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.privacity" />
                        </div>

                        <PrimaryButton>Crear contacto</PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
