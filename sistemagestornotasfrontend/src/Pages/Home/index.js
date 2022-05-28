import { useEffect } from "react";
import { useUser } from "Hooks/useUser";
import { useNavigate } from "react-router-dom";
function Home() {
    const { isLogged, logout, idRol } = useUser();
    const navigate = useNavigate();


    const handleClick = (e) => {
        e.preventDefault();
        logout();

    }

    useEffect(() => {
        console.log("Esta es una prueba");
        console.log(typeof idRol)
        if(!isLogged) {
            navigate("/login");
        } else {
            if(idRol === '1') {
                console.log(idRol);
                navigate("/error403");
            }
        }
    }, [isLogged, navigate, idRol]);
    return(
        <div>
            <h1>Este es mi home</h1>
            <button onClick={handleClick}>CerrarSession</button>
        </div>
    ) 
}

export {Home};