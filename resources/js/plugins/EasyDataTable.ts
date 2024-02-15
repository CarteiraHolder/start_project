import type { Header, Item, ServerOptions } from "vue3-easy-data-table";
import { ref } from 'vue'

export const loading = ref(false)
export const headers = ref<Header[]>([])
export const items = ref<Item[]>([])
export const serverItemsLength = ref(0)
export const serverOptions = ref<ServerOptions>({
    page: 1,
    rowsPerPage: 30,
    sortBy: '',
    sortType: 'asc',
})