<script>
export default {
    name: 'CategoriesEdit'
}
</script>


<script setup>
    import { useForm } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import CategoryForm from '@/Components/Categories/Form.vue';

    const props = defineProps({
        category: {
            type: Object,
            required: true
        }
    });

    //En crear, el form entregaba un valor vacio, aqui entregamos el valor que viene desde el controlador
    const form = useForm({
        name: props.category.name
    });

</script>


<template>
    <AppLayout title="Edit Category">
        <template #header> <!-- El contenido dentro de esta tag, se ubicara en el $slot.headers -->
            <h1 class="font-semibold text-xl text-gray-800 leading-tight" >
                Edit Category
            </h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <CategoryForm
                            :updating="true"
                            :form="form"
                            @submit="form.put(route('categories.update', props.category.id))"
                        />
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
