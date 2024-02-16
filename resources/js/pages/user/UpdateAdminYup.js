import * as yup from "yup";
import { CpfIsInvalid } from "../../helpers/CpfIsInvalid";
import { HasCpfInDB } from "../../helpers/HasCpfInDB";
import { HasEmailInDB } from "../../helpers/HasEmailInDB";
import { RoleEnum } from "../../helpers/RoleEnum";

const RegisterSchema = yup.object().shape({
    name: yup
        .string()
        .required(`O campo nome é obrigatório.`),
    cpf: yup
        .string()
        .required(`O campo CPF é obrigatório`)
        .test("test-invalid-cpf", "O campo CPF inválido", (cpf) =>
            CpfIsInvalid(cpf)
        ),
    email: yup
        .string()
        .required(`O campo email é obrigatório`)
        .email(`O campo email é inválido`),
    role: yup
        .object()
        .nullable("O campo permissão é obrigatório")
        .test(
            "test-invalid-role",
            "O campo permissão é obrigatório",
            (role) => role?.id !== undefined
        ),
});

export default RegisterSchema;