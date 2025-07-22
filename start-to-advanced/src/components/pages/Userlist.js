import React from "react";
import { Link } from "react-router-dom";

export default function Userlist() {
  const arra = [
    { id: 1, name: "Farhan" },
    { id: 2, name: "Asif" },
    { id: 3, name: "Ali" },
    { id: 4, name: "Sheraz" },
  ];

  return (
    <>
      <h4>Userlist</h4>
      <ul>
        {arra.map((item,index) => (
          <li key={index}><Link to={`/userdetail/${item.id}`} style={{ textDecoration:'none' }}>{item.name}</Link></li>
        ))}
      </ul>
    </>
  );
}
