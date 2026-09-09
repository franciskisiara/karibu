<script lang="ts" setup>
import { useQuasar } from 'quasar'
import BasePage from '@/components/BasePage.vue'
import OccupancyList from '@/components/OccupancyList.vue'
import VisitForm from '@/components/VisitForm.vue'
import type { Paginated } from '@/types/common'
import type { Occupancy } from '@/types/models'

const props = defineProps<{
    occupancies: Paginated<Occupancy>,
}>()

const $q = useQuasar()

const launchVisitForm = (occupancy: Occupancy) => {
    $q.dialog({
        component: VisitForm,
        componentProps: {
            occupancy,
        }
    })
}
</script>

<template>
    <BasePage
        title="Occupancies"
        heading="Occupancies"
        :breadcrumbs="[
            { label: 'Occupancies' }
        ]"
    >
        <template #content>
            <OccupancyList
                :occupancies="props.occupancies"
                @invite="launchVisitForm($event)"
            />
        </template>
    </BasePage>
</template>
