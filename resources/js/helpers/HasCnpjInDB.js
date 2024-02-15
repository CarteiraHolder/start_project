
import axiosClient from '../plugins/axios'
import { Mask } from "maska";

const maskedCnpj = "##.###.###/####-##";

export const HasCnpjInDB = async (cnpj) => {
    const MaskedCnpj = new Mask({ mask: maskedCnpj })

    if (MaskedCnpj.unmasked(cnpj) == '') return true;
    if (MaskedCnpj.unmasked(cnpj).length != 14) return true;

    let HasCnpjInDB = true

    await axiosClient.get(`/Contractor/Has/Cnpj/${MaskedCnpj.unmasked(cnpj)}`)
        .then(({ data }) => {
            HasCnpjInDB = !data.data
        })
        .catch(() => HasCnpjInDB = false)


    return HasCnpjInDB
}