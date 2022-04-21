<template>
    <app-layout>
        <Head title="Item" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Items
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="rounded-xl bg-gray-50 border-gray-200 border my-16 mx-8 px-4 py-4">
                        <h2 class="text-lg text-bold border-b border-gray-200 py-2 px-2 mb-2">Add Item To Shopping List</h2>
                        <div class="flex">

                            <div class="w-1/2">
                                <select id="location" v-model="form.item_id" :class="{'bg-red-50': form.errors.item_id}" name="location" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                   <option selected value="">Please Select</option>
                                   <option v-for="item in list" :value="item.value" :disabled="item.disabled">{{item.label}}</option>
                                </select>
                            </div>
                            <div class="w-1/2 flex justify-between px-8">
                                <div class="w-1/4">
                                    <JetInput
                                        id="name"
                                        v-model="form.quantity"
                                        type="number"
                                        class="mt-1 block w-full"
                                        required
                                        autofocus
                                        autocomplete="name"
                                        placeholder="1"
                                    />
                                </div>
                                <div class="w-1/4 flex items-center">
                                    <span @click="submit" class="underline" :class="{'text-gray-black cursor-pointer': form.isDirty, 'cursor-not-allowed text-gray-400': !form.isDirty}">Save</span>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="px-8 my-16 h-screen ">
                        <div v-for="list, department in itemLists" class="my-8">
                            <h2 class="bold text-2xl border-b-2 border-gray-50 py-2">{{department}}</h2>

                            <div class="space-y-4 divide-y divide-y-gray-50">
                                <div v-for="item in list" class="list-decimal px-8 py-4 flex justify-between items-center" :class="{'opacity-25': item.purchased}">
                                    <div class="w-1/2 flex items-center ">
                                        <div class="w-1/2 flex items-center space-x-4">
                                            <input :checked="item.purchased"  type="checkbox" @change="item.purchased = !item.purchased; update(item)" :id="item.id" name="purchased" />
                                            <label :for="item.id" class="block" :href="route( 'items.show', item)" >{{item.name}}</label>
                                        </div>
                                        <div class="w-1/2">
                                            <JetInput
                                                id="name"
                                                v-model="item.quantity"
                                                @change="update(item)"
                                                type="number"
                                                :disabled="item.purchased"
                                                class="mt-1 block w-full"
                                                required
                                                autofocus
                                                autocomplete="name"
                                            />
                                        </div>

                                    </div>
                                    <span class="underline cursor-pointer text-xs" @click="destroy(item.id)">Delete</span>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </app-layout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'
import { computed } from 'vue'
import JetInput from '@/Jetstream/Input.vue';
import JetCheckbox from '@/Jetstream/Checkbox.vue';


const props = defineProps({
    items: Array,
    itemLists: Array
});


const list = computed(() => {
  let output = [];
  Object.keys( props.items ).forEach( key => {
      output.push({
          disabled: true,
          label: key
      })
      props.items[key].forEach( item => {
          output.push({
              label: item.name,
              value: item.id
          })
      } )
  })
  return output;
});

const form = useForm({
    quantity: '',
    item_id: null
});

const destroy = (id) => {

    axios.delete( route('list.destroy', id), {
      maxRedirects  : 0
    }  )
        .then( function(response){
            Inertia.reload();
        } )
}

const submit = () => {
    if ( form.isDirty )
        form.quantity = form.quantity > 0 ? form.quantity : 1;
        form.post(route('list.store'), {
            onSuccess: () => form.reset(),
        } );
};

const update = ( item ) => {
    axios.put( route('list.update', item), item, {
      maxRedirects  : 0
    }  )
        .then( function(response){
            Inertia.reload();
        } )
}

</script>

<style scoped>

</style>
