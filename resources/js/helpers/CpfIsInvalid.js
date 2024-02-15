import { Mask } from "maska";


const MaskedCpf = new Mask({ mask: "###.###.###-##" })

export function CpfIsInvalid(strCPF) {
    strCPF = MaskedCpf.unmasked(strCPF);

    var Sum = 0;
    var Rest;

    if (strCPF == "00000000000") return false;

    for (let i = 1; i <= 9; i++) Sum = Sum + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    Rest = (Sum * 10) % 11;

    if ((Rest == 10) || (Rest == 11)) Rest = 0;
    if (Rest != parseInt(strCPF.substring(9, 10))) return false;

    Sum = 0;
    for (let i = 1; i <= 10; i++) Sum = Sum + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    Rest = (Sum * 10) % 11;

    if ((Rest == 10) || (Rest == 11)) Rest = 0;
    if (Rest != parseInt(strCPF.substring(10, 11))) return false;

    return true;
}

