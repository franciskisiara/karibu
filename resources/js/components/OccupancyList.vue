<script lang="ts" setup>
import { router } from '@inertiajs/vue3'
import type { QTableColumn } from 'quasar'
import BaseDatatable from '@/components/BaseDatatable.vue'
import type { Paginated } from '@/types/common'
import type { Occupancy } from '@/types/models'

const props = defineProps<{
    occupancies: Paginated<Occupancy>,
}>()

const emits = defineEmits([
    'invite'
])

const columns: QTableColumn[] = [
    {
        label: 'Residence',
        name: 'residence',
        field: (occupancy: Occupancy) => occupancy.residential_unit?.residence?.name,
        align: 'left',
    },

    {
        label: 'Residential unit number',
        name: 'unit_number',
        field: (occupancy: Occupancy) => occupancy.residential_unit?.unit_number,
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
    <BaseDatatable :metadata="occupancies.meta">
        <q-table
            flat
            hide-pagination
            icon
            row-key="name"
            :columns="columns"
            :rows="props.occupancies.data"
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
                        label="Send invite"
                        class="text-caption fade-primary text-weight-medium"
                        @click="emits('invite', props.row)"
                    ></q-btn>
                </q-td>
            </template>
        </q-table>
    </BaseDatatable>
</template>
