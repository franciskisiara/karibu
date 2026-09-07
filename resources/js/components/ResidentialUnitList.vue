<script lang="ts" setup>
import { useQuasar, } from 'quasar'
import type { QTableColumn } from 'quasar'
import BaseDatatable from '@/components/BaseDatatable.vue'
import type { Paginated } from '@/types/common'
import type { ResidentialUnit } from '@/types/models'
import OccupancyForm from './OccupancyForm.vue'

const props = defineProps<{
    residentialUnits: Paginated<ResidentialUnit>,
}>()

const $q = useQuasar()
const columns: QTableColumn[] = [
    {
        label: 'Unit number',
        name: 'unit_number',
        field: (unit: ResidentialUnit) => unit.unit_number,
        align: 'left',
    },

    {
        label: 'Occupant',
        name: 'occupant',
        field: ({ occupancies }: ResidentialUnit) => {
            const occupancy = occupancies ? occupancies[0] : null

            return occupancy?.user.name || 'n/a';
        },
        align: 'left',
    },

    {
        label: 'Actions',
        name: 'actions',
        field: 'actions',
        align: 'left',
    },
]

const launchOccupancyForm = (residentialUnit: ResidentialUnit) => {
    $q.dialog({
        component: OccupancyForm,
        componentProps: {
            residentialUnit,
        }
    })
}
</script>

<template>
    <BaseDatatable :metadata="residentialUnits.meta">
        <q-table
            flat
            hide-pagination
            icon
            row-key="name"
            :columns="columns"
            :rows="props.residentialUnits.data"
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
                        label="Add occupant"
                        class="text-caption fade-primary text-weight-medium"
                        @click="launchOccupancyForm(props.row)"
                    ></q-btn>
                </q-td>
            </template>
        </q-table>
    </BaseDatatable>
</template>
