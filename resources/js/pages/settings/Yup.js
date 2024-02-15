import * as yup from "yup";
import { CnpjIsInvalid } from "../../helpers/CnpjIsInvalid";
import { HasCnpjInDB } from "../../helpers/HasCnpjInDB";

const Yup = yup.object().shape({
    apiGeoclearLogUserActionslocation: yup
        .number()
        .required(`O campo Clear log_user_actions | CRON (em dias) é obrigatório.`),
    apiGeolocation: yup
        .object()
        .nullable("O campo API de Geolocalização é obrigatório")
        .test(
            "test-invalid-flag",
            "O campo API de Geolocalização é obrigatório",
            (apiGeolocation) => apiGeolocation?.id !== undefined
        ),

});

export default Yup;