import {CardUser} from "./CardUser";
import { ENDPOINTIMAGE } from 'Config/EndPoint';

function ListCardUser({users}) {

    return (
        <div className = "list-articles">
        { 
            users.map((user) =>(
                <CardUser 
                    key = {user.id}
                    name = { `${user.nombre} ${user.apellido} `}
                    age = { user.fecha_nacimiento }
                    avatar = { (user.avatar === "" || user.avatar === null) ?  
                        `${ENDPOINTIMAGE}/storage/avatar.png` : 
                        `${ENDPOINTIMAGE}${user.avatar}` }
                    rol = {user.rol}
                />
            ))
        }
        </div>

    );

}

export {ListCardUser}
