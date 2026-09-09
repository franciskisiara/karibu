export type Occupancy = {
    id: number,
    user?: User,
    residential_unit?: ResidentialUnit,
}

export type Residence = {
    id: number,
    name: string,
}

export type ResidentialUnit = {
    id: number,
    unit_number: string,
    residence?: Residence,
    occupancies?: Occupancy[],
}

export type User = {
    id: number,
    name: string,
    email: string,
}

export type Visit = {
    id: number,
    welcomed_at: string | null,
    visitor?: User,
    occupancy?: Occupancy,
}
