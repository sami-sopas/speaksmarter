<script setup>

    import { ref } from 'vue'

    defineProps({
        collection: {
            type: Array,
            required: true
        }
    })

    //Aqui se guardan los elementos seleccionados
    const currentSelection = ref(1); //Aqui se guardara la collecion del obj, no solo el nombre o id
    const selection = ref([]);
    const emit = defineEmits(['onCategories']);

    const handleAddToSelection = () => {
        //Comprobar si ya existe el elemento en la seleccion, para evitar duplicados
        let alreadyExists = false;

        selection.value.forEach(item => {
            if (item.id === currentSelection.value.id) {
                alreadyExists = true;
                return;
            }
        });

        if (alreadyExists) {
            return;
        }

        selection.value.push(currentSelection.value);

        //Emitir evento para enviar la seleccion al componente padre
        emit('onCategories', selection.value);
    }

    const handleRemoveSelection = (index) => {
        selection.value = selection.value.filter(item => item.id !== index)

        //Emitir evento para enviar la seleccion al componente padre
        emit('onCategories', selection.value);
    }

</script>

<template>
    <div class="w-full">
        <div class="flex">
            <select v-model="currentSelection" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option v-for="(item, index) in collection" :key="index" :value="item">
                    {{ item?.name }}
                </option>
            </select>

            <button @click.prevent="handleAddToSelection" class="py-2 px-4 ml-1 text-white bg-indigo-500 hover:bg-indigo-700 rounded">
                Add
            </button>
        </div>

        <!-- Elementos seleccionados-->
        <div>
            <ul>
                <li v-for="(item, index) in selection" :key="'index-' + index" @click.prevent="handleRemoveSelection(item.id)" class="mt-1 ml-1 mb-1 py-2 px-4 text-white bg-indigo-500 hover:bg-indigo-700 rounded" >
                    {{ item.name }}
                    <span class="float-right cursor-pointer">X</span>
                </li>
            </ul>
        </div>
    </div>
</template>
