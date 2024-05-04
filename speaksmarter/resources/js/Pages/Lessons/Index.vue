<!-- Este script es para evitar redudancias entre tantos archivos Index que podamos crear-->
<script>
    export default {
        name: 'LessonsIndex'
    }
</script>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/vue3';
    import { Inertia } from '@inertiajs/inertia';
    import { router } from "@inertiajs/vue3";

    defineProps({
        lessons: {
            type: Object,
            required: true
        }
    })

    //Funcion que recibe el id y confirma la eliminacion
    const deleteLesson = id => {
        if(confirm('Are you sure you want to delete this lesson?')){

            //LLamamos a la ruta que se encarga de eliminar la lesson
            router.delete(route('lessons.destroy', id));
        }
    }

</script>

<template>
    <AppLayout>
        <template #header> <!-- El contenido dentro de esta tag, se ubicara en el $slot.headers -->
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Lessons
            </h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between" v-if="$page.props.user.permissions.includes('create lessons')">
                        <Link :href="route('lessons.create')" class="py-2 px-4 text-white bg-indigo-500 hover:bg-indigo-700 rounded">
                        Create lesson
                        </Link>
                    </div>

                    <div class="mt-4">
                        <ul role="list" class="divide-y divide-gray-100">
                            <li v-for="lesson in lessons.data" :key="lesson.id" class="flex justify-between gap-x-6 py-5">
                                <div class="flex min-w-0 gap-x-4">
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-md font-semibold leading-6 text-gray-900">{{ lesson.name }}</p>
                                    </div>
                                </div>
                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    <p class="text-md leading-6 text-gray-900">
                                        <Link v-if="$page.props.user.permissions.includes('update lessons')" :href="route('lessons.edit', lesson.id)" class="py-2 px-4">
                                            Edit
                                        </Link>

                                        <button v-if="$page.props.user.permissions.includes('delete lessons')" @click="deleteLesson(lesson.id)" class="py-2 px-4 text-red-600">
                                            Delete
                                        </button>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Paginacion -->
                    <div class="flex justify-between mt-2">
                            <Link v-if="lessons.current_page > 1" :href="lessons.prev_page_url" class="py-2 px-4">
                                PREVIOUS
                            </Link>
                            <div v-else></div>
                            <Link v-if="lessons.current_page < lessons.last_page" :href="lessons.next_page_url" class="py-2 px-4">
                                NEXT
                            </Link>
                            <div v-else></div>
                    </div>

                </div>

            </div>
        </div>
    </AppLayout>
</template>
