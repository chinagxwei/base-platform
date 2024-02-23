import { Injectable } from '@angular/core';
import {HttpReprint} from "../../utils/http-reprint";
import {Paginate} from "../../models/server-response";
import {SystemRouter} from "../../models/system";
import {ROUTER_DELETE, ROUTER_ITEMS, ROUTER_REGISTERED, ROUTER_SAVE} from "../../api/system.api";


@Injectable({
  providedIn: 'root'
})
export class RouterService {

  constructor(private http: HttpReprint) {
  }

  public items(page: number = 1, query?: SystemRouter | { title: string }) {
    return this.http.post<Paginate<SystemRouter>>(`${ROUTER_ITEMS}?page=${page}`, query)
  }

  public registeredRoute(page: number = 1, query?: SystemRouter | { title: string }) {
    return this.http.post<string[]>(`${ROUTER_REGISTERED}`, query)
  }

  public save(postData: SystemRouter) {
    return this.http.post(ROUTER_SAVE, postData)
  }

  public delete(id: number | undefined) {
    return this.http.post(ROUTER_DELETE, {id})
  }
}
