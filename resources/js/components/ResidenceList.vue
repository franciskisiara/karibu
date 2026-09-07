<script lang="ts" setup>
import { router } from '@inertiajs/vue3'
import type { QTableColumn } from 'quasar'
import BaseDatatable from '@/components/BaseDatatable.vue'
import type { Paginated } from '@/types/common'
import type { Residence } from '@/types/models'

const props = defineProps<{
    residences: Paginated<Residence>,
}>()

const columns: QTableColumn[] = [
    {
        label: 'Name',
        name: 'name',
        field: 'name',
        align: 'left',
    },

    {
        label: 'Actions',
        name: 'actions',
        field: 'actions',
        align: 'left',
    },
]
</script>

<template>
    <BaseDatatable :metadata="residences.meta">
        <q-table
            flat
            hide-pagination
            icon
            row-key="name"
            :columns="columns"
            :rows="props.residences.data"
            :rows-per-page-options="[0]"
            class="no-border-radius"
            wrap-cells
        >
            <template #body-cell-actions="props">
                <q-td :props="props">
                    <q-btn
                        no-caps
                        unelevated
                        padding="5px 15px"
                        label="View units"
                        class="text-caption fade-primary text-weight-medium"
                        @click="router.get(route('residential-units.index', {
                            residence: props.row.id
                        }))"
                    ></q-btn>
                </q-td>
            </template>
        </q-table>
    </BaseDatatable>
</template>
