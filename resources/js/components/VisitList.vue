<script lang="ts" setup>
import type { QTableColumn } from 'quasar'
import BaseDatatable from '@/components/BaseDatatable.vue'
import type { Paginated } from '@/types/common'
import type { Visit } from '@/types/models'

const props = defineProps<{
    visits: Paginated<Visit>,
}>()

const emits = defineEmits([
    'welcome'
])

const columns: QTableColumn[] = [
    {
        label: 'Visitor',
        name: 'visitor',
        field: (visit: Visit) => visit.visitor?.name,
        align: 'left',
    },

    {
        label: 'Residence',
        name: 'unit_number',
        field: (visit: Visit) => visit.occupancy?.residential_unit?.residence?.name,
        align: 'left',
    },

    {
        label: 'Unit number',
        name: 'unit_number',
        field: (visit: Visit) => visit.occupancy?.residential_unit?.unit_number,
        align: 'left',
    },

    {
        label: 'Check in',
        name: 'welcomed_at',
        field: (visit: Visit) => visit.welcomed_at || 'Not arrived',
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
    <BaseDatatable :metadata="visits.meta">
        <q-table
            flat
            hide-pagination
            icon
            row-key="name"
            :columns="columns"
            :rows="props.visits.data"
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
                        label="Receive guest"
                        class="text-caption fade-primary text-weight-medium"
                        @click="emits('welcome', props.row)"
                    ></q-btn>
                </q-td>
            </template>
        </q-table>
    </BaseDatatable>
</template>
