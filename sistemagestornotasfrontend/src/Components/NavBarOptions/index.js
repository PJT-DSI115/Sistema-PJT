import React from "react";
import './index.css';
import { ListOptions } from "./ListOptions";

function NavBarOptions(){
    return(
        <div className="NavBar-right">
            <ul className="NavBar-list">
                <ListOptions />
            </ul>
        </div>
    );
}

export { NavBarOptions };