<script>
    export default {
        name: 'CategoriesCreate'
    }
</script>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import LessonForm from '@/Components/Lessons/Form.vue';

    defineProps({
        categories: {
            type: Object,
            required: true
        },
        levels: {
            type: Object,
            required: true
        }
    });

    const form = useForm({
        name: ''
    });

</script>


<template>
    <AppLayout title="Create Lesson">
        <template #header> <!-- El contenido dentro de esta tag, se ubicara en el $slot.headers -->
            <h1 class="font-semibold text-xl text-gray-800 leading-tight" >
                Create Lesson
            </h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <LessonForm
                                :form="form"
                                :categories="categories"
                                :levels="levels"
                                @submit="form.post(route('lessons.store'))"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>

</template>
