export type Occupancy = {
    id: number,
    user: User,
}

export type Residence = {
    id: number,
    name: string,
}

export type ResidentialUnit = {
    id: number,
    unit_number: string,
    occupancies?: Occupancy[],
}

export type User = {
    id: number,
    name: string,
    email: string,
}
