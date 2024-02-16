import * as yup from "yup";
import { CpfIsInvalid } from "../../helpers/CpfIsInvalid";
import { HasCpfInDB } from "../../helpers/HasCpfInDB";
import { HasEmailInDB } from "../../helpers/HasEmailInDB";

var passwordField = ""

const NewPasswordSchema = yup.object().shape({
    name: yup
        .string()
        .required(`O campo nome é obrigatório.`),
    email: yup
        .string()
        .email(`O campo email é inválido`)
        .required(`O campo email é obrigatório`)
        .test(
            "test-email",
            "Email já cadastrado",
            async (email) => {
                const result = await HasEmailInDB(email);
                return result;
            }
        ),

});

export default NewPasswordSchema;