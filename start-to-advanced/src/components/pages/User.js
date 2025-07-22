import React from "react";
import { useParams } from "react-router-dom";

export default function User() {
  const userid = useParams();
  return (
    <>
      <h3> User id is:{userid.id} </h3>
    </>
  );
}
