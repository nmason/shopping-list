<template>
    <app-layout>
        <Head title="New Department" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{item.name}}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex justify-end py-4 px-8 space-x-4">
                        <Link :href="route('departments.index')" class="underline cursor-pointer">Cancel</Link>
                        <span @click="submit" class="underline" :class="{'text-gray-black cursor-pointer': form.isDirty, 'cursor-not-allowed text-gray-400': !form.isDirty}">Update</span>
                    </div>

                    <div class="px-8 my-16 h-screen ">
                        <form @submit.prevent="submit">
                            <div>
                                <JetLabel for="name" value="Department Name" />
                                <span v-if="form.errors.name" class="text-red-500 text-xs">{{form.errors.name}}</span>
                                <JetInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    :class="{'bg-red-50': form.errors.name}"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />

                            </div>
                            <div class="mt-4">
                                <JetLabel for="name" value="Department" />
                                <span v-if="form.errors.department_id" class="text-red-500 text-xs">{{form.errors.department_id}}</span>
                                <select id="location" v-model="form.department_id" :class="{'bg-red-50': form.errors.department_id}" name="location" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option selected value="">Please Select</option>
                                    <option v-for="department in departments" :value="department.id">{{department.name}}</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';

const props = defineProps({
    item: Object,
    departments: Array
});

const form = useForm({
    name: props.item.name,
    department_id: props.item.department_id
});

const submit = () => {
    if ( form.isDirty )
        form.put(route('items.update', props.item) );
};
</script>

<style scoped>

</style>
