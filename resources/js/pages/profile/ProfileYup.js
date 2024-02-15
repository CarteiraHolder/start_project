import * as yup from "yup";
import { ValidateMyPasswordInDB } from "../../helpers/ValidateMyPasswordInDB";

var passwordField = ""

const ProfileSchema = yup.object().shape({
    name: yup
        .string()
        .nullable('O campo nome é inválido')
        .min(3, 'O campo nome é inválido')
});

export default ProfileSchema;