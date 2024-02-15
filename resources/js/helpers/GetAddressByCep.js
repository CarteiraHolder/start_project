import { Mask } from "maska";
import Loading from "../store/Loading";
import axiosClient from "@/plugins/axios";
import { toast } from "vue3-toastify";

const MaskedCep = new Mask({ mask: "##.###-###" });
let result = null;

export const GetAddressByCep = async (cep) => {
    if (MaskedCep.unmasked(cep) == "") return result;
    if (MaskedCep.unmasked(cep).length != 8) return result;

    Loading.state.loading = true;

    await axiosClient
        .get(`/Address/Cep/${MaskedCep.unmasked(cep)}`)
        .then(({ data }) => {
            result = data.data;

            toast.success("Endereço encontrado", {
                toastId: `/Address/Cep/${Masked.unmasked(cep.value)}`,
                transition: toast.TRANSITIONS.BOUNCE,
                dangerouslyHTMLString: true,
            });
        })
        .catch((error) => { })
        .finally(() => (Loading.state.loading = false));

    return result
}

