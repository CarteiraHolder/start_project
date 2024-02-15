
import axiosClient from '../plugins/axios'
import { Mask } from "maska";

const maskedCpf = "###.###.###-##";

export const HasCpfInDB = async (cpf) => {
    const MaskedCpf = new Mask({ mask: maskedCpf })

    if (MaskedCpf.unmasked(cpf) == '') return true;
    if (MaskedCpf.unmasked(cpf).length != 11) return true;

    let HasCpfInDB = true

    await axiosClient.get(`/User/Has/Cpf/${MaskedCpf.unmasked(cpf)}`)
        .then(({ data }) => {
            HasCpfInDB = !data.data
        })
        .catch(() => HasCpfInDB = false)


    return HasCpfInDB
}