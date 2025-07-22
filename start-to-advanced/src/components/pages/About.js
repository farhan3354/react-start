import React from "react";
import { NavLink, Outlet } from "react-router-dom";

export default function About() {
  return (
    <>
      <h3>About</h3>
      <NavLink to={"subject"} style={{ textDecoration: "none", marginRight:'3px' }}>
        Subject
      </NavLink>
      <NavLink to={"dep"} style={{ textDecoration: "none" }}>
        Dep
      </NavLink>
      <Outlet></Outlet>
    </>
  );
}
