import { ENDPOINT } from "Config/EndPoint";

const registrarNota = ({ data, jwt }) => {
  fetch(`${ENDPOINT}/registrarNota`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${jwt}`,
    },
    body: JSON.stringify(data),
  }).then((response) => response);
}

export {registrarNota}